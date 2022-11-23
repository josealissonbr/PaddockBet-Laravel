<option value="" disabled>-- Selecione --</option>
@foreach ($prova->conjuntos as $conjunto)
<option value="{{$conjunto->idProvaConjunto}}">{{$conjunto->nomeConjunto}} ({{number_format(($prova->saldoAcumulado + ($prova->valor * $qtdCotas)) / ((\App\Models\Apostas::where('idProva', $prova->idProva)->where('ConjuntoEscolhido', $conjunto->idProvaConjunto)->sum('qtdeCotas') + $qtdCotas) * $prova->valor) + 1, 2, '.')}}x)</option>
@endforeach
