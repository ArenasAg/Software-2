package Primera_pregunta;

public class Main {
    public static void main(String[] args) {
        FabricaServicioEnvio fabricaExpress = new FabricaEnvioExpress();
        ServicioEnvio servicioExpress = fabricaExpress.crearServicioEnvio();
        servicioExpress.enviar("Paquete #1");

        FabricaServicioEnvio fabricaRegular = new FabricaEnvioRegular();
        ServicioEnvio servicioRegular = fabricaRegular.crearServicioEnvio();
        servicioRegular.enviar("Paquete #2");
    }
}

