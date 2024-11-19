public class Main {
    public static void main(String[] args) {
        IServicioEmail gmail = new EmailGmailImpl();
        IServicioEmail yahoo = new EmailYahooImpl();
        IServicioEmail outlook = new EmailOutlookImpl();

        Email emailGmail = new EmailGmail("GMAIL", "Ola", "", "File");
        Sistema sistema = new Sistema(gmail);
        sistema.enviarEmail(emailGmail);

        Email emailYahoo = new EmailYahoo("YAHOO", "Ola", "", "ola");
        sistema = new Sistema(yahoo);
        sistema.enviarEmail(emailYahoo);

        Email emailOutlook = new EmailOutlook("OUTLOOK", "Ola", "jesus");
        sistema = new Sistema(outlook);
        sistema.enviarEmail(emailOutlook);
    }
}