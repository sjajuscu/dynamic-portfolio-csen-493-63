package CSEN275.DPG.model;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Lob;
import jakarta.persistence.Table;

import java.util.Date;

@Entity
@Table(name = "users")
public class User {
    @Column(name = "portfolio_id")
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private String name;
    private String email;
    private String contact;     // phone number
    private int age;
    private String residence;
    private String address;

    @Lob
    @Column(name = "aboutme", columnDefinition = "MEDIUMTEXT")
    private String aboutme;
    private Date addedon;

    public User() {
    }

    public User(String name, String email, String contact, int age, String residence, String address, String aboutme) {
        this.name = name;
        this.email = email;
        this.contact = contact;
        this.age = age;
        this.residence = residence;
        this.address = address;
        this.aboutme = aboutme;
        this.addedon = new Date();
    }

    public Long getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public String getEmail() {
        return email;
    }

    public String getContact() {
        return contact;
    }

    public int getAge() {
        return age;
    }

    public String getResidence() {
        return residence;
    }

    public String getAddress() {
        return address;
    }

    public String getAboutme() {
        return aboutme;
    }

    public Date getAddedon() {
        return addedon;
    }

    public void setName(String name) {
        this.name = name;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public void setContact(String contact) {
        this.contact = contact;
    }

    public void setAge(int age) {
        this.age = age;
    }

    public void setResidence(String residence) {
        this.residence = residence;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public void setAboutme(String aboutme) {
        this.aboutme = aboutme;
    }

    public void update(User newUser) {
        name = newUser.getName();
        email = newUser.getEmail();
        contact = newUser.getContact();
        age = newUser.getAge();
        residence = newUser.getResidence();
        address = newUser.getAddress();
        aboutme = newUser.getAboutme();
    }
}
