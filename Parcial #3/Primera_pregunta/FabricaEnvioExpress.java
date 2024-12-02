package Primera_pregunta;

public class FabricaEnvioExpress implements FabricaServicioEnvio {
    @Override
    public ServicioEnvio crearServicioEnvio() {
        return new ServicioEnvioExpress();
    }
}