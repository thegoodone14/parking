<?php
//@extends('layouts.app')

//@section('content')
echo'<!DOCTYPE html>'
echo'<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">'
echo'<div class="container text-center">'
    echo'<h1 class="my-4">PARKING</h1>'

    echo'<div class="row">'
        echo'<div class="col-md-6 mb-3">'
            echo'<a href="{{ route('reservations.create') }}" class="btn btn-primary btn-lg btn-block">Demander une nouvelle réservation</a>'
        echo'</div>'

echo'        div class="col-md-6 mb-3">'
echo'         <a href="{{ route('reservations.index') }}" class="btn btn-primary btn-lg btn-block">Réservation en cours</a>' 
       echo ' </div>'
    echo '</div>'
    echo '<div class="row">'
     echo    '<div class="col-md-6 mb-3">'
           echo '<a href="{{ route('waitlist') }}" class="btn btn-primary btn-lg btn-block">Liste dattente</a>'
                   echo'</div>'
    echo'</div>'
echo'</div>'
echo '</html>';
//@endsection


?>
