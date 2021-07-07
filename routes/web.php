<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','FrontEnd\FrontController@index');
Route::get('/view_report_card','FrontEnd\FrontController@view_result');
Route::get('/admin/upload_gallery','HomeController@upload_gallery_show');
Route::get('/admin/admin_staff','HomeController@upload_staff_show');

Route::get('/admin/admin_staff/delete/{id}', ['as'=>'delete_staff','uses'=>'HomeController@delete_staff']);
Route::get('/admin/upload_gallery/delete/{id}', ['as'=>'delete_gallery','uses'=>'HomeController@delete_gallery']);

Route::post('generate-pdf','FrontEnd\FrontController@pdfview')->name('generate-pdf');
Route::post('/admin/add-gallery','HomeController@add_gallery')->name('add_gallery');
Route::post('/admin/add-staff','HomeController@add_staff')->name('add_staff');


Auth::routes();

Route::prefix('admin')->group(function () {

Route::get('/', 'Admin\AdminController@index')->name('admin');

//SCHOOL SETUP
Route::get('/school-setup', 'Admin\AdminController@school_setup')->name('SchoolSetup');
Route::post('/add-session', 'Admin\AdminController@add_session')->name('AddSession');
Route::post('/add-class', 'Admin\AdminController@add_class')->name('AddClass');
Route::post('/add-term', 'Admin\AdminController@add_term')->name('AddTerm');
Route::post('/add-subject', 'Admin\AdminController@add_subject')->name('AddSubject');
Route::post('/add-resumption', 'Admin\AdminController@add_resumption')->name('AddResumption');
Route::post('/add-fee','Admin\AdminController@add_fee')->name('AddFee');
Route::post('/add-block','Admin\AdminController@add_block')->name('AddBlock');


Route::get('/delete-block/{id}', ['as'=>'delete_block','uses'=>'Admin\AdminController@delete_block']);
Route::get('/delete-session/{id}', ['as'=>'delete_session','uses'=>'Admin\AdminController@delete_session']);
Route::get('/delete-subjects/{id}', ['as'=>'delete_subjects','uses'=>'Admin\AdminController@delete_subjects']);
Route::get('/delete-classes/{id}', ['as'=>'delete_classes','uses'=>'Admin\AdminController@delete_classes']);
Route::get('/delete-terms/{id}', ['as'=>'delete_term','uses'=>'Admin\AdminController@delete_term']);
Route::get('/delete-logo/{id}', ['as'=>'delete_logo', 'uses'=>'Admin\AdminController@delete_logo']);
Route::get('/delete-stamp/{id}', ['as'=>'delete_stamp', 'uses'=>'Admin\AdminController@delete_stamp']);

//STUDENTS SECTION
Route::get('/add-students', 'Admin\AdminController@add_students')->name('AddStudents');
Route::get('/add-students-reg', 'Admin\AdminController@add_students_reg')->name('RegisterStudents');
Route::post('/add-students', 'Admin\AdminController@add_students_submit')->name('NewStudents');

Route::get('/view-students', 'Admin\AdminController@view_students')->name('ViewStudents');
Route::get('/view-students-sorted', 'Admin\AdminController@view_students_sorted')->name('ViewStudentsSorted');

Route::get('/students/edit/{id}/{class_name}', ['as' => 'show_students', 'uses' =>'Admin\AdminController@view_update_student'])->where('id','[0-9]+')->where('class_name','[a-zA-Z0-9]+');
Route::post('/update-student/{id}/{class_name}', 'Admin\AdminController@update_student')->name('AddTeachers')->where('id','[0-9]+')->where('class_name','[a-zA-Z0-9]+');

Route::get('/students/delete/{id}/{class_name}', ['as'=>'delete_student', 'uses'=>'Admin\AdminController@delete_student'])->where('id','[0-9]+')->where('class_name','[a-zA-Z0-9]+');
Route::get('/teacher/delete/{id}', ['as'=>'delete_teacher', 'uses'=>'Admin\AdminController@delete_teacher'])->where('id','[0-9]+');

Route::get('/form-teacher/delete/{id}', ['as'=>'delete_form_teacher', 'uses'=>'Admin\AdminController@delete_form_teacher'])->where('id','[0-9]+');


Route::delete('/students/delete-multiple-students', ['as'=>'student.multiple-delete','uses'=>'Admin\AdminController@deleteMultiple']);

Route::post('/students/promote-multiple-students', ['as'=>'promote.multiple-students','uses'=>'Admin\AdminController@promoteMultiple']);

Route::get('/bulk-report-view', 'Admin\AdminController@bulk_view_report')->name('BulkViewReport');

Route::get('/view-master-sheet', 'Admin\AdminController@view_master_sheet')->name('ViewMaster');
Route::get('/mastersheet-generate-pdf','Admin\AdminController@masterlist_pdf')->name('mastersheet-generate-pdf');
Route::get('/admin-generate-pdf','Admin\AdminController@view_report_pdf')->name('admin-generate-pdf');
Route::get('/admin-generate-bulkreport-pdf','Admin\AdminController@bulk_report_pdf')->name('admin-generate-bulkreport-pdf');
Route::get('/view-student-list', 'Admin\AdminController@student_list')->name('ViewStudentList');
Route::get('/student-generate-pdf','Admin\AdminController@student_list_pdf')->name('student-generate-pdf');


Route::get('/view-student-sex', 'Admin\AdminController@student_list_sex')->name('ViewStudentSex');
Route::get('/view-student-list-by-sex', 'Admin\AdminController@student_list_by_sex')->name('ViewStudentListBySex');
Route::get('/student-generate-by-sex-pdf','Admin\AdminController@student_list_by_sex_pdf')->name('StudentGenerateSex-pdf');


Route::post('/promote', 'Admin\AdminController@promote')->name('Promote');

Route::get('/bulkresult', 'Admin\AdminController@bulkuploadmarks')->name('Marks');

Route::get('/importExport', 'Admin\MaatwebsiteController@importExport');
Route::get('/downloadExcel/{class_name}/{block}/{session_name}/{type}', 'Admin\MaatwebsiteController@downloadExcel');
Route::post('/importExcel/', 'Admin\MaatwebsiteController@importExcel');

Route::get('/marks/importExport', 'Admin\BulkMarksController@importExport');
Route::get('/marks/downloadExcel/{class_name}/{block}/{session_name}/{term_name}/{type}', 'Admin\BulkMarksController@downloadExcel');
Route::post('/marks/importExcel/', 'Admin\BulkMarksController@importExcel');

//STUDENTS MARKS SECTION
Route::get('/marks/student/{id}/{class}', ['as' => 'marks', 'uses' =>'Admin\AdminController@marks'])->where('id','[0-9]+')->where('class','[a-zA-Z0-9]+');

Route::post('/add-marks/{id}', ['as' => 'add-marks', 'uses' => 'Admin\AdminController@add_marks'])->where('id','[0-9]+');

Route::get('/edit-marks/student/{id}/{class}', ['as' => 'show_marks', 'uses' =>'Admin\AdminController@show_edit_marks'])->where('id','[0-9]+')->where('class','[a-zA-Z0-9]+');

Route::post('/update-marks/{id}', ['as' => 'update', 'uses' =>'Admin\AdminController@update_marks'])->where('id','[A-Za-z0-9]+');

Route::get('/result/student/{id}/{class}', ['as' => 'result', 'uses' =>'Admin\AdminController@view_report'])->where('id','[0-9]+')->where('class','[a-zA-Z0-9]+');

Route::get('/mastersheet', 'Admin\AdminController@master_sheet')->name('MasterSheet');

//SCHOOL FEES SECTION
Route::get('/school-fees-list', 'Admin\FeesController@index')->name('SchoolFees');
Route::get('/admin-generate-school-fees-pdf','Admin\FeesController@school_fees_list_pdf')->name('admin-generate-school-fees-pdf');



//TEACHERS SECTION
Route::get('/view-teachers', 'Admin\AdminController@view_teachers')->name('ViewTeachers');
Route::get('/add-teachers', 'Admin\AdminController@view_to_add')->name('ViewAddTeachers');
Route::post('/add-teachers', 'Admin\AdminController@add_teachers')->name('AddTeachers');

Route::get('/view-form-teachers', 'Admin\AdminController@view_form_teachers')->name('ViewFormTeachers');
Route::get('/add-form-teachers', 'Admin\AdminController@view_to_add_form_teachers')->name('ViewAddFormTeachers');
Route::post('/add-form-teachers', 'Admin\AdminController@add_form_teachers')->name('AddFormTeachers');
Route::post('/add-image', 'Admin\AdminController@add_school_logo')->name('add_logo');
Route::post('/add-principal-stamp', 'Admin\AdminController@add_principal_stamp')->name('add_stamp');


//Route::post('/post/edit/{id}',['as' => 'edit', 'uses' => 'PostController@update'])->where('id','[0-9]+');

//Route::get('/view-master-sheet/', ['as' => 'result', 'uses' =>'Admin\AdminController@view_master_sheet']);

//SCRATCH CARD SECTION

Route::get('/card-generator', 'Admin\CardController@view_cards')->name('ViewcardGenerator');

Route::post('/card-generate', 'Admin\CardController@generate_cards')->name('cardGenerator');

Route::get('/card/delete/{id}', ['as'=>'delete_cards', 'uses'=>'Admin\CardController@destroy'])->where('id','[0-9]+');

//POST
Route::get('/post', 'Admin\PostController@index')->name('post');
Route::post('/add_post', 'Admin\PostController@create')->name('CreatePost');
Route::get('/post/edit/{id}', ['as'=>'update_post', 'uses'=>'Admin\PostController@edit'])->where('id','[0-9]+');;
Route::post('/post', 'Admin\PostController@update')->name('UpdatePost');
Route::get('/post/delete/{id}', ['as'=>'delete_posts', 'uses'=>'Admin\PostController@destroy'])->where('id','[0-9]+');
//END POST

});