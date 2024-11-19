import java.math.BigInteger;

public class User {
    private String name;
    private String email;
    private String password;
    private BigInteger salary;

    public User(String name, String email, String password, BigInteger salary) {
        this.name = name;
        this.email = email;
        this.password = password;
        this.salary = salary;
    }

    public String getname() {
        return name;
    }

    public String getEmail() {
        return email;
    }

    public String getPassword() {
        return password;
    }

    public BigInteger getSalary() {
        return salary;
    }

    public String getInformation() {
        return "Nombre: " + name + "\nEmail: " + email + "\nSalario: " + salary;
    }
}
