@extends('layouts.layout-1')

@php $e_d = $event->description(); @endphp

@section('header')
	<a href="{{ url()->previous() }}" class="btn btn-primary">�����</a>
    �������� ����������� �{{$e_d->name}}�
@endsection


@section('content')
@if ($event->is_local == true)
    <h4>��������� ����������� ({{$e_d->type}}), ���� ����������: {{\Carbon\Carbon::createFromTimeStamp(strtotime($event->event_parameter->max_date))->format('d.m.Y')}}</h4>
@endif

<div class="card">
    <div class="card-body">
        <h5>������������� ������������:</h5>
        <table class="table table-bordered datatables-demo">
            <thead>
            <tr><th>������������</th><th>���������</th>
            <th>���� ��������� ����������</th>
            @if ($event->event_type_id != 2)
            <th>���������</th>
            @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($event->event_results as $result)
            <tr>
            <td>{{$result->user->name}}</td>
            <td>{{$result->is_passed == 1 ? "�������": ""}}</td>
            <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($result->last_activity))->format('d.m.y H:i:s')}}</td>
            @if ($event->event_type_id != 2)
                <td><a href="#" data-toggle="modal" data-remote="/adm/events/{{$event->id}}/results/{{$result->user->id}}"  data-target="#myModal" class="btn btn-primary">���������</a></td>
            @endif
            </tr> 
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal" id="myModal">
	<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
          <h4 class="modal-title">������� ����� ����</h4>
        </div>

        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
                    		<label class="form-label form-label-lg">��������</label>
                    		<input type="text" class="form-control " placeholder="" name="name" required="">
                		</div>
						<div class="form-group">
							<label class="form-label form-label-lg">�������� (�������������):</label>
							<textarea class="form-control" placeholder="" rows="5" name="description"></textarea>
						</div>
					</div>
				</div>
        	</div>
	       
    </div>
</div>


@endsection

@section('scripts')

<script type="text/javascript">
	$('.datatables-demo').dataTable();
    function delete_local_event(event,name)
	{
		Swal.fire({
			title: '������� ��������� ����������� '+name+'?',
			text: '��� ���������� ��� ����������� ����� �������',
			type: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#FFF',
			confirmButtonText: '�������',
			cancelButtonText: '������'
			
		}).then((result) => {
		if (result.value) {
			$('#e_'+event).submit();
  		}
        })
    }
</script>
<script type="text/javascript">
$('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-content').load($(this).data("remote"));
    }); 
</script>


@if (\Session::has('success_delete'))
    <script>
        toastr.success('{!! \Session::get('success_delete') !!}', '�����!',{"positionClass": "toast-bottom-right",})
    </script>
@endif
@endsection