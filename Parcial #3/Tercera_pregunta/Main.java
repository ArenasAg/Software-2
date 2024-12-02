package Tercera_pregunta;

public class Main {
    public static void main(String[] args) {
        NuevoSistemaPago nuevoSistema = new NuevoSistemaPago("Anderson Arenas Gonzalez", "1056122404", "anderson.arenasg@autonoma.edu.co");

        SistemaPagoAntiguo sistemaPago = new AdaptadorSistemaPago(nuevoSistema);
        sistemaPago.iniciarSesion(nuevoSistema.getNombre());
        sistemaPago.validarEmail(nuevoSistema.getCorreo());
        sistemaPago.autorizarPago();
        sistemaPago.ejecutarPago();
    }
}
