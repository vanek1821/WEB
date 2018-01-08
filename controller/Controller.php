<?php
	//Předek všech kontrolerů
	abstract class Controller {
		
		//atribut pohledu
		protected $view;

		//metoda pro zobrazení
		abstract function Display();

		//metoda vykonávající funkcí kontroleru
		abstract function DoWork();
}
?>