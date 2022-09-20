<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    // ZEGY OTC CUSTOM
    // https://codeigniter4.github.io/CodeIgniter4/libraries/validation.html#how-to-save-your-rules
    // public $createAccount = [
    //     'nama_lengkap' => [
    //         'label' => 'nama lengkap',
    //         'rules' => 'required|min_length[3]'
    //     ],
    //     'username' => [
    //         'label' => 'username',
    //         'rules' => 'required|min_length[5]|alpha_dash|is_unique[t_user.user_name]'
    //     ],
    //     'email' => [
    //         'label' => 'email',
    //         'rules' => 'required|valid_email|is_unique[t_user.user_email]'
    //     ],
    //     'nomor_handphone' => [
    //         'label' => 'nomor handphone',
    //         'rules' => 'required|min_length[8]|numeric'
    //     ],
    //     'password' => [
    //         'label' => 'password',
    //         'rules' => 'required|min_length[8]'
    //     ],
    //     'konfirmasi_password' => [
    //         'label' => 'konfirmasi password',
    //         'rules' => 'required|matches[password]'
    //     ],
    //     'profile_img' => [
    //         'label' => 'foto profil',
    //         'rules' => 'uploaded[profile_img]|is_image[profile_img]|mime_in[profile_img,image/jpg,image/jpeg]|max_size[profile_img,30]|max_dims[profile_img,200,200]'
    //     ],
    //     'bio' => [
    //         'label' => 'bio',
    //         'rules' => 'required|max_length[250]',
    //     ],
    //     'jenis_kelamin' => [
    //         'label' => 'Jenis kelamin',
    //         'rules' => 'required'
    //     ],
    // ];

    public $createAccount = [
        'nama_lengkap' => [
            'label' => 'nama lengkap',
            'rules' => 'required|min_length[3]'
        ],
        'username' => [
            'label' => 'username',
            'rules' => 'required|min_length[5]|alpha_dash|is_unique[t_user.user_name]'
        ],
        'email' => [
            'label' => 'email',
            'rules' => 'required|valid_email|is_unique[t_user.user_email]'
        ],
        'nomor_handphone' => [
            'label' => 'nomor handphone',
            'rules' => 'required|min_length[8]|numeric'
        ],
        'password' => [
            'label' => 'password',
            'rules' => 'required|min_length[8]'
        ],
        'konfirmasi_password' => [
            'label' => 'konfirmasi password',
            'rules' => 'required|matches[password]'
        ],
        'jenis_kelamin' => [
            'label' => 'Jenis kelamin',
            'rules' => 'required'
        ],
    ];
}
