@component('mail::message')
# Réinitialisation de mot de passe

Cliquez sur le bouton ci-dessous pour réinitialiser votre mot de passe :

@component('mail::button', ['url' => $resetUrl])
Réinitialiser le mot de passe
@endcomponent

Si vous n'avez pas demandé de réinitialisation de mot de passe, vous pouvez ignorer cet email.

Merci,<br>
L'équipe de {{ config('app.name') }}
@endcomponent