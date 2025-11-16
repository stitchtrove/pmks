<div>
    <form wire:submit="create" class="fi-sc-form">
        {{ $this->form }}
        
        <button type="submit" class="fi-color fi-color-primary fi-bg-color-400 hover:fi-bg-color-300 dark:fi-bg-color-600 dark:hover:fi-bg-color-500 fi-text-color-900 hover:fi-text-color-800 dark:fi-text-color-950 dark:hover:fi-text-color-950 fi-btn fi-size-md  fi-ac-btn-action">
            Submit
        </button>
    </form>
    
    <x-filament-actions::modals />
</div>