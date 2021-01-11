<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
$autoload['helper'] = array('globals');

Lastly, for usage from anywhere within the code you can do this to set the variables:

Globals::setAuthenticatedMemeberId('somememberid');

And this to read it:

Globals::authenticatedMemeberId();

*/

// Application specific global variables
class Globals
{
    public function __construct() {

        

        // Make instance of CodeIgniter to use its resources
        $CI = & get_instance();
        $data['total_inbox'] = 'jumlah inbox pesan akuuuuuuuuuuuuuuuuu';
        // Load data into CodeIgniter
        $CI->load->vars($data);
        

    }
    public $total_inbox = 'jumlah inbox pesan';
    public $descriptionku = 'My feed description';

    private static $authenticatedMemberId = null;
    private static $idPage = null;
    private static $idContact = null;
    private static $initialized = false;

    private static function initialize()
    {
        if (self::$initialized)
            return;

        self::$authenticatedMemberId = null;
        self::$idPage = null;
        self::$idContact = null;
        self::$initialized = true;
    }

    public static function setAuthenticatedMemeberId($memberId)
    {
        self::initialize();
        self::$authenticatedMemberId = $memberId;
    }


    public static function authenticatedMemeberId()
    {
        self::initialize();
        return self::$authenticatedMemberId;
    }
    //id produk
    public static function setIdpage($id)
    {
        self::initialize();
        self::$idPage = $id;
    }


    public static function idPage()
    {
        self::initialize();
        return self::$idPage;
    }
    //contact
    public static function setContact($id)
    {
        self::initialize();
        self::$idContact = $id;
    }


    public static function idContact()
    {
        self::initialize();
        return self::$idContact;
    }
}