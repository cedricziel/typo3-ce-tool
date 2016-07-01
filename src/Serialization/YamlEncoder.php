<?php

namespace CedricZiel\T3CETool\Serialization;

use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * @package CedricZiel\T3CETool\Serialization
 */
class YamlEncoder implements EncoderInterface, DecoderInterface
{
    /**
     * Encodes PHP data to a YAML string
     * {@inheritdoc}
     */
    public function encode($data, $format, array $context = [])
    {
        return Yaml::dump($data);
    }

    /**
     * {@inheritdoc}
     */
    public function decode($data, $format, array $context = [])
    {
        return Yaml::parse($data);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsEncoding($format)
    {
        return 'yaml' === $format;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDecoding($format)
    {
        return 'yaml' === $format;
    }
}
