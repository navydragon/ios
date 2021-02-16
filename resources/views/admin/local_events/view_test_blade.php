<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4 class="modal-title">�������� ���������� ���������� ����������� {{$ev->name}}</h4>
</div>
<form method="POST" name="event_form" action="/adm/local_events/add_test">
  @csrf
<div class="modal-body">
  <h5>1. �������� ����</h5>
  <p>� ������� ������� ������������ ���������� ��������</p>
  <div class="custom-controls-stacked">
  <select name="test_id" class="custom-select" required>
    <option selected value="">�������� ����</option>
    @foreach ($tests as $elem)
        <option value="{{$elem->id}}">{{$elem->name}} ({{$elem->questions_count}})</option>
    @endforeach
    </select>    
  </div>
  <hr>
  <div>
    <h5>2. ��������� ��������� �����</h5>
    <div class="form-group">
      <label class="form-label">���������� �������� � �����</label>
      <input type="number" required name="show_questions" class="form-control">
    </div>
    <div class="form-group">
      <label class="form-label">���������� �������� ��� ������</label>
      <input type="number" required name="passing_score" class="form-control">
    </div>
    <div class="form-group">
      <label class="form-label">������������ ���������� �������</label>
      <input type="number" required name="max_attempts" class="form-control">
    </div>
    <div class="form-group">
      <label class="form-label">����� �� ���� ������� (�����)</label>
      <input type="number" required name="attempt_time" class="form-control">
    </div>
    <div class="form-group">
      <label class="form-label">����, �� ������� ����� ��������� ����</label>
      <input type="date" required name="max_date" class="form-control">
    </div>
  </div>
</div>

<div class="modal-footer">
    <a href="#" data-dismiss="modal" class="btn btn-default">������</a>
    <button type="submit"  class="btn btn-primary">��������</button>   
</div>
</form>
