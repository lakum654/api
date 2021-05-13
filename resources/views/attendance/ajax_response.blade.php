<?php $count = 1?>
@foreach($users as $key => $user)    
@foreach($result['date'] as $date)
<?php $checkData = App\Attendance::where('user_id',$user->user->id)->whereDate('date',$date)->orderBy('date','desc')->get() ?>
@if($checkData->count() > 0)
<tr>
    <td>{{ $count++ }}</td>
    <td>{{ $user->user->name}}</td>
    <td style="font-size:14px">{{ date('D d-m-Y',strtotime($date)) }}</td>
    <td style="font-size:10px">
    @foreach($checkData as $value)
        {{ $value->in_time }} - {{ $value->in_time }}<br>    
    @endforeach
    </td>
    <td>{{  App\Helpers\Helper::secondTo($checkData->sum('session_hours')) }}</td>
    <td>{{ $checkData->pluck('status')->last() == 0 ? 'Not-Out' : 'Out-Completed'}}</td>
</tr>
@endif
@endforeach
@endforeach
