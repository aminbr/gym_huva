<?php
    
    echo $this->render('_form',[
        'memberModel' => $memberModel,
        'jobArray' => $jobArray,
        'title' => 'ایجاد عضو',
        'valueBtn' => 'ثبت عضو',
    ]);

