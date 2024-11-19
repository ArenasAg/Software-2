public class Usuario {
    private ControladorVenta controlador = new ControladorVenta();

    public void comprar(String tipoEntrada) {
        controlador.comprarEntrada(tipoEntrada);
    }

    public void agregarEntrada(Entrada entrada) {
        controlador.agregarEntrada(entrada);
    }
}