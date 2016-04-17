<div class="box {{ $options['boxtype'] or 'default' }}">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>
        <div class="box-tools pull-right">
            {!! $options['toolbox'] or '' !!}
        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
        {!! $content !!}
    </div><!-- /.box-body -->
    @if(!is_null($footer))
        <div class="box-footer">
            {!! $footer !!}
        </div><!-- box-footer -->
    @endif
</div><!-- /.box -->