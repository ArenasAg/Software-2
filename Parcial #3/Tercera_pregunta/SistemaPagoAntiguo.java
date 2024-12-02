package Tercera_pregunta;

public interface SistemaPagoAntiguo {
    void iniciarSesion(String usuario);
    void validarEmail(String email);
    void autorizarPago();
    void ejecutarPago();
}