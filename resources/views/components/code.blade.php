
<div x-data="{ expanded: false }">
    <div  class="mt-3 mb-3 p-2 bg-gray-200 border border-gray-400">
    
        <button @click="expanded = ! expanded" >
            <span class="text-xs" x-show="!expanded">▶ </span>
            <span class="text-xs" x-show="expanded">▼ </span>
            View Code
        </button>
    </div>
    
    @if (empty(env('TORCHLIGHT_TOKEN')))
      <div class="mt-2"><pre><code x-show="expanded" x-collapse>{{ $slot }}</code></pre></div>  
    @else
        <div class="mt-2 text-sm"><pre><x-torchlight-code x-show="expanded" x-collapse language="php" theme="material-theme-darker">{{ $slot }}</x-torchlight-code></pre></div>
    @endif
</div>

