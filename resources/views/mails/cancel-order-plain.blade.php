{{ mb_strtoupper('Nouvelle commande') }}<br /><br /><br />
Un client viens d'annuler une commande
le {{ $order->fr_updated_date }} à {{ $order->fr_updated_time }}.
Voici les détails de cette commande:<br /><br />
Nom & Prénom: {{ $order->user->format_full_name }}<br />
Email: {{ $order->user->email }}<br />
Tel: {{ $order->user->phone }}<br />
Commande N°: {{ $order->reference }}<br /><br />
<a href="{{ route('admin.orders.index') }}" target="_blank">Valider la commande</a><br /><br />
Si ce bouton ne fonctionne pas, essayez de copier et coller
cet URL dans votre navigateur web. Si le problème perssiste,
s'il vous plais sentez vous libre de contacter l'équipe
de developpement.<br /><br />
@lang('general.admin_thanks', ['app' => config('app.name')])<br /><br /><br />
&copy; 2018 {{ config('app.name') }}, @lang('general.right').