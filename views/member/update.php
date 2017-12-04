<?php

echo $this->render('_form',[
    'memberModel' => $memberModel,
    'jobArray' => $jobArray,
    'title' => 'ویرایش عضو',
    'valueBtn' => 'ثبت ویرایش',
]);
