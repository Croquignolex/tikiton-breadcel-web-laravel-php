@extends('layouts.mail')

@section('title', 'Nouveau client')

@section('head', mb_strtoupper('Nouveau client'))

@section('body')
    <tr>
        <td>
            <p style="text-align: justify;">
                <strong>
                    Un nouveau client viens de confirmer son compte
                    le {{ $user->fr_updated_date }} à {{ $user->fr_updated_time }}.
                    Voici les informations de base ce client:
                </strong>
            </p>
            <p style="text-align: justify;">
                <strong>Prénom:</strong> {{ $user->format_first_name }}<br />
                <strong>Nom:</strong> {{ $user->format_last_name }}<br />
                <strong>Email:</strong> {{ $user->email }}
            </p>
            <div style="text-align: center;">
                <a href="#" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #da7612; text-decoration:none;" target="_blank">
                    Souhaitez lui la bienvenue
                </a>
            </div>
            <p style="text-align: justify;">
                Si ce bouton ne fonctionne pas, essayez de copier et coller
                cet URL dans votre navigateur web. Si le problème perssiste,
                s'il vous plais sentez vous libre de contacter l'équipe
                de developpement.
            </p>
        </td>
    </tr>
@endsection
