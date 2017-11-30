@extends('layouts.app')

@section('content')
	<h1>About</h1>
	<p>
		The weights of the neural network were obtained by an evolutionary algorithm (an approach now called neuroevolution). In this case, a population of Blondie24-like programs played each other in checkers, and those were eliminated that performed relatively poorly. Performance was measured by a points system: Each program earned one point for a win, none for a draw, and two points were subtracted for a loss. Points were earned for each neural network after a multiple of games; the neural networks did not know which individual games were won, lost, or drawn. After the poor programs were eliminated, the process was repeated with a new population derived from the winners. In this way, the result was an evolutionary process that selected programs that played better checkers games.
	</p>
@endsection

@section('sidebar')
	@parent
	<p>this is the appended sidebar</p>
@endsection