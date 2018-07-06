{{ mb_strtoupper('Nouveau client') }}<br /><br /><br />
Un nouveau client viens de confirmer son compte
le {{ $user->fr_updated_date }} à {{ $user->fr_updated_time }}.
Voici les informations de base ce client:<br /><br />
Nom: {{ $user->format_name }}<br />
Email: {{ $user->email }}<br /><br />
<a href="#" target="_blank">Souhaitez lui la bienvenue</a><br /><br />
Si ce bouton ne fonctionne pas, essayez de copier et coller
cet URL dans votre navigateur web # Si le problème perssiste,
s'il vous plais sentez vous libre de contacter l'équipe
de developpement.<br /><br />
@lang('general.admin_thanks', ['app' => config('app.name')])<br /><br /><br />
&copy; 2018 {{ config('app.name') }}, @lang('general.right').