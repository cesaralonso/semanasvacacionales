@if($flash = session('error'))
     <script type="text/javascript">makeToast('Error','{{$flash}}', 'WARNING');</script>
@elseif($flash = session('message'))
     <script type="text/javascript">makeToast('Mensaje','{{$flash}}', 'SUCCESS');</script>
@endif