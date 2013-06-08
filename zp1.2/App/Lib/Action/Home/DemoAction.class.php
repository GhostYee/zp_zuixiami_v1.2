<?php
// Demo
class DemoAction extends CommonAction {
    public function index() {
        $this->display();
    }

    public function upload() {
        require('App/Lib/ORG/Net/UploadHandler.class.php');
        //import('ORG.Net.UploadHandler');
        $upload_handler = new UploadHandler(array(
            'script_url' => 'http://'.$_SERVER['HTTP_HOST'].__ACTION__,
            'upload_dir' => dirname($_SERVER['SCRIPT_FILENAME']).'/Upload/Userimg/',
            'upload_url' => 'http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/Upload/Userimg/',
        ));
    }
}