@foreach ($prova->conjuntos as $conjunto)
<option value="{{$conjunto->idProvaConjunto}}">{{$conjunto->nomeConjunto}} ({{($prova->saldoAcumulado + ($prova->valor * $qtdCotas)) / $prova->valor}}x)</option>
@endforeach
