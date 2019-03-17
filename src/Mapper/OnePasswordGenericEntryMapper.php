<?php

namespace App\Mapper;

use App\Model\GenericEntry;
use App\Model\OnePasswordEntry;

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

        $genericEntry->setNotes($this->compileNotes($object));

        return $genericEntry;
    }

    protected function detectUsernameFrom(OnePasswordEntry $object): ?string
    {
        switch ($object->getTypeName()) {
            case 'webforms.WebForm':
                return $this->getItemFromFields($object, 'username');
                break;
            case 'wallet.computer.License':
                return $object->getSecureContents()->getRegCode();
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
        }

        return null;
    }

    protected function compileNotes(OnePasswordEntry $object)
    {
        // TODO compile notes from remaining fields?
        // - generate additional URL's that are not present in GenericEntry URL field
        // - iterate on SectionFields

        return $object->getSecureContents()->getNotesPlain();
    }

    public function supports($object): bool
    {
        return $object instanceof OnePasswordEntry;
    }
}
