package CSEN275.DPG.model;

import com.fasterxml.jackson.annotation.JsonBackReference;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.Table;

import java.util.Objects;

@Entity
@Table(name = "education")
public class EducationalDetails {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @JsonBackReference
    @ManyToOne
    @JoinColumn(name = "portfolio_id", nullable = false)
    private Portfolio portfolio;

    private String school;
//    @Enumerated
    private String degree;

//    @ElementCollection
//    @CollectionTable(name = "majors", joinColumns = @JoinColumn(name = "education_id"))
    private String majors;

    private int yearStart;
    private int yearEnd;

    public EducationalDetails() {
    }

    public EducationalDetails(String school, String degree, String majors, int yearStart, int yearEnd) {
        this.school = school;
        this.degree = degree;
        this.majors = majors;
        this.yearStart = yearStart;
        this.yearEnd = yearEnd;
    }

    public Long getId() {
        return id;
    }

    public Portfolio getPortfolio() {
        return portfolio;
    }

    public String getDegree() {
        return degree;
    }

    public String getMajors() {
        return majors;
    }

    public int getYearStart() {
        return yearStart;
    }

    public int getYearEnd() {
        return yearEnd;
    }

    public String getSchool() {
        return school;
    }

    public void setPortfolio(Portfolio portfolio) {
        this.portfolio = portfolio;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public void setMajors(String majors) {
        this.majors = majors;
    }

    public void setSchool(String school) {
        this.school = school;
    }

    public void setDegree(String degree) {
        this.degree = degree;
    }

    public void setYearStart(int yearStart) {
        this.yearStart = yearStart;
    }

    public void setYearEnd(int yearEnd) {
        this.yearEnd = yearEnd;
    }

    public void update(EducationalDetails newDetails) {
        school = newDetails.getSchool();
        degree = newDetails.getDegree();
        yearStart = newDetails.getYearStart();
        yearEnd = newDetails.getYearEnd();
    }

    public boolean similar(EducationalDetails other) {
        return Objects.equals(school, other.school) &&
                Objects.equals(degree, other.degree) &&
                Objects.equals(yearStart, other.yearStart) &&
                Objects.equals(yearEnd, other.yearEnd) &&
                Objects.equals(majors, other.majors);
    }
}
