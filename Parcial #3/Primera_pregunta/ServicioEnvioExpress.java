package Primera_pregunta;

public class ServicioEnvioExpress implements ServicioEnvio {
    @Override
    public void enviar(String paquete) {
        System.out.println("Enviando el paquete de forma 'Express': " + paquete);
    }
}
