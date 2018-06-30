@inject('languageService', 'App\Services\LanguageService')

@component('components.top-header-drop-down', [
    'selected_icon' => flag_img_asset($languageService->getCurrentLanguage()),
    'selected' => trans($languageService->getLanguageFullName($languageService->getCurrentLanguage()))
    ])
    @foreach($languageService->getLanguages() as $language)
        <li>
            <a href="{{ $languageService->isActiveLanguage($language) ? 'javascript: void(0);' : $languageService->getUrl($language) }}"
                title="{{ $languageService->getTitle($language) }}">
                <img src="{{ flag_img_asset($language) }}" alt="...">
                @lang($languageService->getLanguageFullName($language))
            </a>
        </li>
    @endforeach
@endcomponent