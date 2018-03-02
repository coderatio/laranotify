<div data-notify='container'
     class='col-xs-11 col-sm-7 col-md-6 col-lg-5 col-xl-4 ln-notify-wrap alert alert-{0}'
     role='alert'>
    <a  aria-hidden='true' class='ln-notify-close' data-notify='dismiss'><i class='sl sl-icon-close'></i></a>
    <span data-notify='icon'></span>
    <span data-notify='title' class='bold text-uppercase d-inline-block uk-text-truncate'>{1}</span><br/>
    <span data-notify='message' class='ln-notify-message' @if(notify()->icon == '') style='margin-left: 0' @endif>{2}</span>
    <div class='progress' data-notify='progressbar'>
        <div class='progress-bar progress-bar-striped progress-bar-animated bg-{0}' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%;'></div>
    </div>
    <a href='{3}' target='{4}' data-notify='url'></a>
</div>
