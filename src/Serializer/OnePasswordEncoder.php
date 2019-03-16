<?php

namespace App\Serializer;

use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

class OnePasswordEncoder implements EncoderInterface, DecoderInterface, SerializerAwareInterface
{
    const FORMAT = '1pif';

    use LoggerAwareTrait;

    /** @var SerializerInterface|DecoderInterface */
    protected $serializer;

    public function __construct(LoggerInterface $logger)
    {
        $this->setLogger($logger);
    }

    public function encode($data, $format, array $context = [])
    {
        throw new \InvalidArgumentException('not implemented');
    }

    public function supportsEncoding($format): bool
    {
        return false;
    }

    public function decode($data, $format, array $context = [])
    {
        return array_filter(array_map(function ($line) use ($context) {
            if (empty($line) || strpos($line, '***') === 0) {
                return false; // skip the UUID's, don't need them
            }

            try {
                return $this->serializer->decode($line, 'json', $context);
            } catch (\Throwable $exception) {
                $this->logger->error('unable to decode this line from json!', ['line' => $line]);

                return false;
            }
        }, explode(PHP_EOL, $data)));
    }

    public function supportsDecoding($format): bool
    {
        return self::FORMAT === $format;
    }

    /**
     * Sets the owning Serializer object.
     */
    public function setSerializer(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }
}
