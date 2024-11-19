public class CanalGmail implements ICanalNotificacion {
    @Override
    public void enviarCorreo(Notificacion notificacion) {
        System.out.println("Enviando correo vía Gmail:");
        System.out.println("Asunto: " + notificacion.getAsunto());
        System.out.println("Cuerpo: " + notificacion.getCuerpo());
    }
}
