import java.math.BigInteger;

public class Main {
    public static void main(String[] args) {

        //Crear un usuario
        User user = new User("Anderson Arenas", "anderson.arenasg@autonoma.edu.co", "ola123", new BigInteger("1300000"));

        // Obtener información del usuario y mostrarla
        System.out.println(user.getInformation());

        // Validar contraseña
        PasswordValidator passwordValidator = new PasswordValidator();
        boolean isValidate = passwordValidator.validatePassword(user.getPassword());
        System.out.println("Contraseña válida: " + isValidate);

        // Enviar el correo electrónico
        EmailService emailService = new EmailService();
        emailService.sendEmail(user.getEmail(), "Primer taller", "Taller realizado!");

        // Calcular salario anual
        SalaryCalculator salaryCalculator = new SalaryCalculator();
        BigInteger salaryAnual = salaryCalculator.calculateSalary(user.getSalary());
        System.out.println("Salario anual: " + salaryAnual);
    }
}
