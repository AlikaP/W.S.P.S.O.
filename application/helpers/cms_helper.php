<?php 


function btn_edit($uri)
{
	return anchor($uri, '<i class="icon-edit"></i>');
}	

function btn_delete($uri)
{
	return anchor($uri, '<i class="icon-remove"></i>', array('onClick' => "return confirm('Jeste li sigurni?');"));
}		

function boss($nadleznost, $id) //onemogućiti brisanje šefa
{
    if($nadleznost != 'Šef')
    {
        return btn_delete('admin/user/delete/' . $id);
    }
}

function boss_check($nadleznost) //onemogućiti izmjenu user_type za šefa (uvijek je admin)
{
    if($nadleznost != 'Šef')
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable 
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        
        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
        
        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}

//ako se prenosi obični niz
function my_form_dropdown($atribut, $result_array, $v, $css)
{ 
    $options = array();       //redni br niza => jedna vrijednost niza
    foreach ($result_array as $key=>$vrijednost)
    { 
        $options[$vrijednost] = $vrijednost;  // $options = array('vrijednost'=>'vrijednost')
    }

    return form_dropdown($atribut, $options, $v, $css);
}

//ako se prenosi objekt (niz)
function my_form_dropdown_2($atribut1, $atribut2, $result_array, $v, $css)
{
    $options = array();       
    foreach ($result_array as $key=>$vrijednost)
    { 
        $options[$vrijednost->$atribut1] = $vrijednost->$atribut1;  //$user->name
        //$options[dino] = dino;   -mora biti kako bi se u niz $options upisalo ime korisnika
    }
    return form_dropdown($atribut2, $options, $v, $css);
}



/*
function my_form_dropdown($name, $result_array){
    $options = array();
    foreach ($result_array as $key => $value){
        $options[$value['id']] = $value['value'];
    }
    return form_dropdown($name, $options);
}
*/


if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}

//------------------------------------------------------------------------

    function dateform($retrieved) //YYYY-MM-DD u DD-MM-YYYY
    {
        $date = DateTime::createFromFormat('Y-m-d', $retrieved);
        return $date->format('d-m-Y');
    }

    //------------------------------------------------------------------------

    function dateform_($retrieved) //DD-MM-YYYY u YYYY-MM-DD
    {
        $date = DateTime::createFromFormat('d-m-Y', $retrieved);
        return $date->format('Y-m-d');
    }

    //------------------------------------------------------------------------

    function datetimeform($retrieved) //YYYY-MM-DD u DD-MM-YYYY
    {
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $retrieved);
        return $date->format('d-m-Y H:i:s');
    }

    //------------------------------------------------------------------------

    function datetimeform_($retrieved) //DD-MM-YYYY u YYYY-MM-DD
    {
        $date = DateTime::createFromFormat('d-m-Y H:i:s', $retrieved);
        return $date->format('Y-m-d H:i:s');
    }  

//------------------------------------------------------------------------

function end_s($preuzeto, $id)  //za onemogućavanje edit-a servisa nakon zaključavanja
{
    if($preuzeto != TRUE)
    {
        return btn_edit('admin/service/edit/' . $id);
    }
}

function end_ss($preuzeto, $id)  //za onemogućavanje edit-a servisa nakon zaključavanja
{
    if($preuzeto != TRUE)
    {
        return btn_edit('mech/service/edit/' . $id);
    }
}

//------------------------------------------------------------------------
