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
@Table(name = "experience")
public class ExperienceDetails {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @JsonBackReference
    @ManyToOne
    @JoinColumn(name = "portfolio_id", nullable = false)
    private Portfolio portfolio;

    private String company;
    private String details;

    private int yearStart;
    private int yearEnd;

    public ExperienceDetails() {
    }

    public ExperienceDetails(String company, String details, int yearStart, int yearEnd) {
        this.company = company;
        this.details = details;
        this.yearStart = yearStart;
        this.yearEnd = yearEnd;
    }

    public Long getId() {
        return id;
    }

    public String getCompany() {
        return company;
    }

    public String getDetails() {
        return details;
    }

    public int getYearStart() {
        return yearStart;
    }

    public int getYearEnd() {
        return yearEnd;
    }

    public Portfolio getPortfolio() {
        return portfolio;
    }

    public void setPortfolio(Portfolio portfolio) {
        this.portfolio = portfolio;
    }

    public void setCompany(String company) {
        this.company = company;
    }

    public void setDetails(String details) {
        this.details = details;
    }

    public void setYearStart(int yearStart) {
        this.yearStart = yearStart;
    }

    public void setYearEnd(int yearEnd) {
        this.yearEnd = yearEnd;
    }

    public void update(ExperienceDetails newDetails) {
        company = newDetails.getCompany();
        details = newDetails.getDetails();
        yearStart = newDetails.getYearStart();
        yearEnd = newDetails.getYearEnd();
    }

    public boolean similar(ExperienceDetails other) {
        return Objects.equals(company, other.company) &&
                Objects.equals(details, other.details) &&
                Objects.equals(yearStart, other.yearStart) &&
                Objects.equals(yearEnd, other.yearEnd);
    }
}
