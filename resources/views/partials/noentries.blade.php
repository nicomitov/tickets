<div class="notice notice-{{ !empty($alert) ? $alert : 'warning' }}">
    <i class="fas fa-{{ !empty($icon) ? $icon : 'info ' }} fa-lg fa-fw" aria-hidden="true" role="button"></i>
    @if(!empty($msg)) {{ $msg }} @else Sorry, nothing to show! @endif
</div>
