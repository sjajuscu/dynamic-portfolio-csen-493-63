package CSEN275.DPG.model;

import com.fasterxml.jackson.annotation.JsonBackReference;
import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.Table;
import jakarta.persistence.Transient;

import java.io.File;
import java.util.Objects;

@Entity
@Table(name = "project")
public class Project {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @JsonBackReference
    @ManyToOne
    @JoinColumn(name = "portfolio_id", nullable = false)
    private Portfolio portfolio;

    private String title;
    @Column(name = "`desc`")
    private String description;
    @Column(name = "image")
    private String imagePath;
    private int yearStart;
    private int yearEnd;

    @Transient
    private File imageFile;

    public Project() {
    }

    public Project(String title, String desc, File imageFile, int yearStart, int yearEnd) {
        this.title = title;
        this.description = desc;
        this.imageFile = imageFile;
        this.yearStart = yearStart;
        this.yearEnd = yearEnd;
        this.imagePath = "./";
    }

    public Long getId() {
        return id;
    }

    public Portfolio getPortfolio() {
        return portfolio;
    }

    public String getTitle() {
        return title;
    }

    public String getDescription() {
        return description;
    }

    public String getImage() {
        return imagePath;
    }

    public File getImageFile() {
        return imageFile;
    }

    public int getYearStart() {
        return yearStart;
    }

    public int getYearEnd() {
        return yearEnd;
    }

    public void setPortfolio(Portfolio portfolio) {
        this.portfolio = portfolio;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public void setImage(String imagePath) {
        this.imagePath = imagePath;
    }

    public void setYearStart(int yearStart) {
        this.yearStart = yearStart;
    }

    public void setYearEnd(int yearEnd) {
        this.yearEnd = yearEnd;
    }

    public void setImageFile(File imageFile) {
        this.imageFile = imageFile;
    }

    public void update(Project newDetails) {
        title = newDetails.getTitle();
        description = newDetails.getDescription();
        imageFile = newDetails.getImageFile();
        yearStart = newDetails.getYearStart();
        yearEnd = newDetails.getYearEnd();
    }

    public boolean similar(Project other) {
        return Objects.equals(title, other.title) &&
                Objects.equals(description, other.description) &&
                Objects.equals(yearStart, other.yearStart) &&
                Objects.equals(yearEnd, other.yearEnd);
    }
}
