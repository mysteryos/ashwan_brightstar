<?php
/**
 * Created by PhpStorm.
 * Name: Trait to add libraries in controllers
 * User: kpudaruth
 * Date: 23/10/2015
 * Time: 08:52
 */

namespace App\Traits;

trait VendorLibraries
{
    public function addjQueryBootgrid()
    {
        $this->addJs('/js/jquery.bootgrid.js');
        $this->addCss('/vendors/bootgrid/jquery.bootgrid.min.css',true);
    }

    /*
     * Depends on Moment Js
     */
    public function addBootstrapDatetimePicker()
    {
        $this->addCss('/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',true);
        $this->addJs('/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js');
    }

    /*
     * Depends on Moment Js
     */
    public function addLiveStamp()
    {
        $this->addJs('/js/livestamp.js');
    }

    public function addMoment()
    {
        $this->addJs('/vendors/bower_components/moment/min/moment.min.js');
    }

    public function addJqueryValidate()
    {
        $this->addJs('/vendors/bower_components/jquery-validation/dist/jquery.validate.js');
    }

    public function addZxcvbn()
    {
        $this->addJs('/vendors/bower_components/zxcvbn/dist/zxcvbn.js');
    }

    public function addChosen()
    {
        $this->addJs('/vendors/bower_components/chosen/chosen.jquery.min.js');
        $this->addCss('/vendors/bower_components/chosen/chosen.min.css',true);
    }

    public function addFullCalendar()
    {
        $this->addJs('/vendors/bower_components/fullcalendar/dist/fullcalendar.js');
        $this->addCss('/vendors/bower_components/fullcalendar/dist/fullcalendar.css',true);
    }

    public function addAutoSize()
    {
        $this->addJs('/vendors/bower_components/autosize/dist/autosize.js');
    }

    public function addAt()
    {
        $this->addJs('/vendors/bower_components/Caret.js/dist/jquery.caret.min.js');
        $this->addJs('/vendors/bower_components/At.js/dist/js/jquery.atwho.min.js');
        $this->addCss('/vendors/bower_components/At.js/dist/css/jquery.atwho.min.css');
    }

    public function addCommentAssets()
    {
        $this->addAt();
        $this->addAutoSize();
        $this->addJs('/js/el/comment.js');
    }

    public function addDatatables()
    {
        $this->addCss('//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.11/css/jquery.dataTables.min.css');

        $this->addJs('//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.11/js/jquery.dataTables.min.js');

    }

    public function addFileInput()
    {
        $this->addJs('/vendors/fileinput/fileinput.min.js');
    }

    public function addSummerNote()
    {
        $this->addCss('/vendors/summernote/dist/summernote.css');

        $this->addJs('/vendors/summernote/dist/summernote.min.js');
    }

}