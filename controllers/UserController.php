<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
//require_once('Elequents/UserRepository.php');
//require_once('Contracts/UserRepositoryInterface.php');
class UserController{

//    protected $userRepository;
//    public function __construct(UserRepository $userRepository)
//    {
//        $this->userRepository = $userRepository;
//    }

    public function index(){
        var_dump('index');
        die();
    }

    public function create(){
//        echo $this->userRepository->create();
        var_dump('create');
        die();
    }

    public function update(){
//        echo $this->userRepository;
//        echo $this->userRepository->update();
        var_dump('update');
        die();
    }

    public function destroy(){
//        echo $this->userRepository->destroy();
        var_dump('destroy');
        die();
    }
}