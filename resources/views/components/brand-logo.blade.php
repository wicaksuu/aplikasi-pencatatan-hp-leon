@props(['iconSize' => 24, 'textSize' => 'text-xl', 'class' => ''])
<div class="flex items-center gap-2 {{ $class }}">
    <div class="rounded bg-gradient-to-tr from-violet-600 to-sky-400 flex items-center justify-center shadow-lg shadow-violet-500/30"
         style="width: {{ $iconSize }}px; height: {{ $iconSize }}px;">
        <svg xmlns="http://www.w3.org/2000/svg" class="text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
             style="width: {{ round($iconSize * 0.625) }}px; height: {{ round($iconSize * 0.625) }}px;" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
        </svg>
    </div>
    <span class="font-bold tracking-tight text-white {{ $textSize }}">Le<span class="text-sky-400 font-light">on</span></span>
</div>
