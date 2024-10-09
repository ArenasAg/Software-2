public class CanalOutlook implements ICanalNotificacion {
    @Override
    public void enviarCorreo(Notificacion notificacion) {
        System.out.println("Enviando correo vía Outlook:");
        System.out.println("Asunto: " + notificacion.getAsunto());
        System.out.println("Cuerpo: " + notificacion.getCuerpo());
    }
}