<?php
foreach (Languages::lookup(config('app.locales'), config('app.locale'))as $lang => $value) :?>
<?php if ($lang != app()->getLocale()) :
$traducciones = Languages::lookup(config('app.locales'), $lang);
?>
<li class="nav-item"><a href="{{ route('lang', [$lang]) }}" class="menu-link-item" title="<?php echo ucfirst($traducciones[$lang]);?>"><img class="mt-2" src="{{ url('images/lang/'.$lang.'.png') }}" title="<?php echo ucfirst($traducciones[$lang]);?>" /></a></li>
<?php endif;?>
<?php endforeach;?>