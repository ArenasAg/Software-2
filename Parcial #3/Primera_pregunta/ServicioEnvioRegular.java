package Primera_pregunta;

public class ServicioEnvioRegular implements ServicioEnvio {
    @Override
    public void enviar(String paquete) {
        System.out.println("Enviando el paquete de forma 'Regular': " + paquete);
    }
}