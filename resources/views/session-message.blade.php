@if ($messages)
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        @if(is_array($messages))
            <ul>
                @foreach ($messages as $message)
                    <li><?php echo $message ?></li>
                @endforeach
            </ul>
        @else
            <?php echo $messages ?>
        @endif
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        @if(count($errors === 1))
            <?php echo $errors->first() ?>
        @else
            <ul>
                @foreach ($errors->all() as $error)
                    <li><?php echo $error ?></li>
                @endforeach
            </ul>
        @endif
    </div>
@endif