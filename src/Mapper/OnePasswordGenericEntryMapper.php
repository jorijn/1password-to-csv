<?php

namespace App\Mapper;

use App\Model\GenericEntry;
use App\Model\OnePasswordEntry;
use App\Model\OnePasswordSection;
use App\Model\OnePasswordSectionField;
use App\Model\OnePasswordUrl;

class OnePasswordGenericEntryMapper implements GenericEntryMapperInterface
{
    const TYPE_MAPPER = [
        'passwords.Password' => 'Passwords',
        'webforms.WebForm' => 'Logins',
        'wallet.computer.License' => 'Software Licenses',
        'securenotes.SecureNote' => 'Secure Notes',
        'wallet.computer.Database' => 'Databases',
        'wallet.financial.BankAccountUS' => 'Bank Accounts',
        'wallet.financial.CreditCard' => 'Credit Cards',
        'identities.Identity' => 'Identities',
        'wallet.computer.Router' => 'Routers',
        'wallet.government.DriversLicense' => 'Drivers Licenses',
        'wallet.computer.UnixServer' => 'Unix Servers',
    ];

    public function createFrom($object): GenericEntry
    {
        /** @var OnePasswordEntry $object */
        $genericEntry = new GenericEntry();
        $genericEntry->setTitle($object->getTitle());
        $genericEntry->setCreatedAt($object->getCreatedAt());
        $genericEntry->setLastModified($object->getUpdatedAt());
        $genericEntry->setUrl($object->getLocation());
        $genericEntry->setGroup(self::TYPE_MAPPER[$object->getTypeName()] ?? $object->getTypeName());

        $genericEntry->setUsername($this->detectUsernameFrom($object));
        $genericEntry->setPassword($this->detectPasswordFrom($object));

        $genericEntry->setNotes($this->compileNotes($object, $genericEntry));

        return $genericEntry;
    }

    protected function detectUsernameFrom(OnePasswordEntry $object): ?string
    {
        switch ($object->getTypeName()) {
            case 'webforms.WebForm':
                return $this->getItemFromFields($object, 'username');
                break;
        }

        return null;
    }

    protected function getItemFromFields(OnePasswordEntry $object, string $item)
    {
        foreach ($object->getSecureContents()->getFields() as $field) {
            if ($field->getDesignation() === $item) {
                return $field->getValue();
            }
        }

        return null;
    }

    protected function detectPasswordFrom(OnePasswordEntry $object): ?string
    {
        switch ($object->getTypeName()) {
            case 'passwords.Password':
                return $object->getSecureContents()->getPassword();
                break;
            case 'webforms.WebForm':
                return $this->getItemFromFields($object, 'password');
                break;
            case 'wallet.computer.License':
                return $object->getSecureContents()->getRegCode();
                break;
        }

        return null;
    }

    protected function compileNotes(OnePasswordEntry $object, GenericEntry $genericEntry)
    {
        $compiledNotes = [];

        // this should filter out any fields or sections that don't contain any data
        /** @var OnePasswordSection[] $filledSections */
        $filledSections = array_filter(array_map(function (OnePasswordSection $section) {
            $filledFields = array_filter(array_map(function (OnePasswordSectionField $field) {
                return !empty($field->getV()) ? $field : false;
            }, $section->getFields()));

            $section->setFields($filledFields);

            return count($filledFields) > 0 ? $section : false;
        }, $object->getSecureContents()->getSections()));

        foreach ($filledSections as $section) {
            $sectionTitle = $section->getTitle() ?? $section->getName() ?? null;
            $sectionNote = '';
            if (!empty($sectionTitle)) {
                $sectionNote .= '# '.$sectionTitle;
            }
            foreach ($section->getFields() as $field) {
                $sectionNote .= PHP_EOL.'- '.$field->__toString();
            }

            $compiledNotes[] = trim($sectionNote);
        }

        $mainNotes = $object->getSecureContents()->getNotesPlain();
        if (!empty($mainNotes)) {
            $compiledNotes[] = '# Notes'.PHP_EOL.$mainNotes;
        }

        // grab additional URL's
        /** @var OnePasswordUrl[] $urls */
        $urls = array_filter(array_map(function (OnePasswordUrl $url) use ($genericEntry) {
            return $url->getUrl() !== $genericEntry->getUrl() ? $url : false;
        }, $object->getSecureContents()->getURLs()));

        if (count($urls) > 0) {
            $urlNote = '# Additional URL\'s';
            foreach ($urls as $url) {
                $label = $url->getLabel();
                $urlNote .= PHP_EOL.'- '.$url->getUrl().($label ? ' ('.$label.')' : null);
            }

            $compiledNotes[] = $urlNote;
        }

        return implode(PHP_EOL.PHP_EOL, $compiledNotes);
    }

    public function supports($object): bool
    {
        return $object instanceof OnePasswordEntry;
    }
}
