@inject('languageService', 'App\Services\LanguageService')

@component('components.app.top-header-drop-down', [
    'selected_icon' => flag_img_asset($languageService->getCurrentLanguage()),
    'selected' => trans($languageService->getLanguageFullName($languageService->getCurrentLanguage()))
    ])
    @foreach($languageService->getLanguages() as $language)
        <li>
            <a href="{{ $languageService->isActiveLanguage($language) ? '#' : $languageService->getUrl($language) }}">
                <img src="{{ flag_img_asset($language) }}" alt="...">
                @lang($languageService->getLanguageFullName($language))
            </a>
        </li>
    @endforeach
@endcomponent