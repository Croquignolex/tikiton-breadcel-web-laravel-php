<?php

if(!function_exists('locale_route'))
{
    /**
     * @param $name
     * @param array|null $parameters
     * @return string
     */
    function locale_route($name, array $parameters = null)
    {
        //--Get current language
        $language = Illuminate\Support\Facades\App::getLocale();

        //--Return the correct rout with local
        return $parameters == null ?
            route($name, compact('language')) :
            route($name, array_collapse([
                compact('language'),
                $parameters
            ]));
    }
}

if(!function_exists('flash_message'))
{
    /**
     * @param $title
     * @param $message
     * @param string $type
     * @param string $icon
     * @param string $enter
     * @param string $exit
     * @param int $delay
     */
    function flash_message($title, $message, $type = 'info', $icon = 'fa fa-check', $enter = 'lightSpeedIn', $exit = 'lightSpeedOut',  $delay = 5000)
    {
        session()->flash('notification.icon', $icon);
        session()->flash('notification.type', $type);
        session()->flash('notification.title', $title);
        session()->flash('notification.delay', $delay);
        session()->flash('notification.message', $message);
        session()->flash('notification.animate.exit', $exit);
        session()->flash('notification.animate.enter', $enter);
    }
}

if(!function_exists('text_format'))
{
    /**
     * @param $text
     * @param $maxCharacters
     * @return string
     */
    function text_format($text, $maxCharacters)
    {
        if(strlen($text) <= $maxCharacters)
            return $text;
        else
            return substr($text, 0, $maxCharacters) . '...';
    }
}

if(!function_exists('colors'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function colors()
    {
        return collect([
            'secondary', 'dark', 'info',
            'primary', 'theme', 'warning',
            'success', 'danger'
        ]);
    }
}

if(!function_exists('get_index_in_collection'))
{
    /**
     * @param \Illuminate\Support\Collection $collection
     * @param $element
     * @return int
     */
    function get_index_in_collection(\Illuminate\Support\Collection $collection, $element)
    {
        $i = 0;

        foreach ($collection as $_element)
        {
            if($_element == $element) break;
            $i++;
        }

        return $i;
    }
}

if(!function_exists('icons'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function icons()
    {
        return collect([
            'user', 'ambulance', 'at', 'beer', 'bed', 'users', 'film',
            'birthday-cake', 'book', 'building', 'bus', 'taxi',
            'shopping-cart', 'credit-card', 'child', 'dollar-sign',
            'futbol', 'gem', 'gift', 'glass-martini', 'handshake',
            'heart', 'history', 'home', 'laptop', 'lemon', 'mobile',
            'money-bill-alt', 'paw', 'plane', 'shower', 'signal', 'smile',
            'star', 'tasks', 'thumbtack', 'tint', 'trash-alt', 'umbrella',
            'university', 'utensils', 'venus-mars', 'wrench', 'wifi', 'question', 'users'
        ]);
    }
}

if(!function_exists('get_element_in_collection'))
{
    /**
     * @param \Illuminate\Support\Collection $collection
     * @param $index
     * @return string
     */
    function get_element_in_collection(\Illuminate\Support\Collection $collection, $index)
    {
        $elements_number = $collection->count();

        if($index <= 0) return $collection[0];
        elseif($index >= $elements_number) return $collection[$elements_number - 1];
        else return $collection[$index];
    }
}