<?php

namespace AlexChadwick\Uuid;


/**
 * Class Uuid
 * @package AlexChadwick\Uuid
 *
 * @property string $string
 *
 */
class Uuid {

    const UUID_VALID_REGEX = '~^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$~i';
    const UUID_NIL_REGEX   = '~^[0]{8}-[0]{4}-[0]{4}-[0]{4}-[0]{12}$~i';
    const UUID_V1_REGEX    = '~^[0-9a-f]{8}-[0-9a-f]{4}-1[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$~i';
    const UUID_V2_REGEX    = '~^[0-9a-f]{8}-[0-9a-f]{4}-2[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$~i';
    const UUID_V3_REGEX    = '~^[0-9a-f]{8}-[0-9a-f]{4}-3[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$~i';
    const UUID_V4_REGEX    = '~^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$~i';
    const UUID_V5_REGEX    = '~^[0-9a-f]{8}-[0-9a-f]{4}-5[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$~i';

    /**
     * An array of all validation regexes.
     *
     * @var array
     */
    protected $regexes = [
        'UUID_VALID' => self::UUID_VALID_REGEX,
        'UUID_NIL' => self::UUID_NIL_REGEX,
        'UUID_V1' => self::UUID_V1_REGEX,
        'UUID_V2' => self::UUID_V2_REGEX,
        'UUID_V3' => self::UUID_V3_REGEX,
        'UUID_V4' => self::UUID_V4_REGEX,
        'UUID_V5' => self::UUID_V5_REGEX,
    ];


    /**
     * @param string $uuid
     * @throws Exception
     */
    protected function __construct($uuid)
    {
        $this->string = $uuid;
    }

    /**
     * Returns string of generated UUID using passed version
     * @param int $ver
     * @return Uuid
     * @throws Exception
     */
    public static function generate($ver = 4)
    {
        /* Create a new UUID based on provided data. */
        switch ((int)$ver) {
            case 1:
                // Version 1 is not supported
                throw new Exception('Version 1 is unsupported.');
            case 2:
                // Version 2 is not supported
                throw new Exception('Version 2 is unsupported.');
            case 3:
                // Version 3 is not supported
                throw new Exception('Version 3 is unsupported.');
            case 4:
                return new static(Uuid::uuid4());
            case 5:
                // Version 5 is not supported
                throw new Exception('Version 5 is unsupported.');
            default:
                throw new Exception('Selected version is invalid or unsupported.');
        }
    }

    /**
     * Returns string of generated UUID_V4
     * @return string
     */
    public static function uuid4() {
        if (function_exists('com_create_guid') === true)
        {
            //A GUID is generated in the same way as DCE UUID's, except that the Microsoft convention is to enclose a GUID in curly braces.
            return trim(com_create_guid(), '{}');
        }

        $data = openssl_random_pseudo_bytes(16);
        assert(strlen($data) == 16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    /**
     * Import and validate an UUID
     *
     * @param Uuid|string $uuid
     *
     * @return boolean
     */
    public static function validate($uuid)
    {
        return (boolean) preg_match(static::UUID_V4_REGEX, $uuid);
    }


    /**
     * Return the UUID when casted to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }
}