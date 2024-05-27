package CSEN275.DPG.model;

import CSEN275.DPG.error.EducationNotFoundException;
import CSEN275.DPG.error.ExperienceNotFoundException;
import CSEN275.DPG.error.ProjectNotFoundException;
import jakarta.persistence.CascadeType;
import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.OneToMany;
import jakarta.persistence.Table;
import jakarta.persistence.Transient;

import java.util.HashSet;
import java.util.Objects;
import java.util.Set;

@Entity
@Table(name = "portfolio")
public class Portfolio {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(unique = true)
    private Long userId;

    @OneToMany(mappedBy = "portfolio", cascade = CascadeType.ALL)
    private Set<EducationalDetails> educations;

    @OneToMany(mappedBy = "portfolio", cascade = CascadeType.ALL)
    private Set<ExperienceDetails> experiences;

    @OneToMany(mappedBy = "portfolio", cascade = CascadeType.ALL)
    private Set<Project> projects;

    @Transient
    private User user;

    public Portfolio() {
    }

    public Portfolio(User user) {
        this.user = user;
        this.userId = user.getId();
        educations = new HashSet<>();
        experiences = new HashSet<>();
        projects = new HashSet<>();
    }

    public Long getId() {
        return id;
    }

    public Long getUserId() {
        return userId;
    }

    public Set<EducationalDetails> getEducations() {
        return educations;
    }

    public Set<ExperienceDetails> getExperiences() {
        return experiences;
    }

    public Set<Project> getProjects() {
        return projects;
    }

    public void addEducationalDetails(EducationalDetails details) {
        details.setPortfolio(this);
        educations.add(details);
    }

    public void addExperienceDetails(ExperienceDetails details) {
        details.setPortfolio(this);
        experiences.add(details);
    }

    public void addProject(Project project) {
        project.setPortfolio(this);
        projects.add(project);
    }

    public EducationalDetails getEducation(Long eId) {
        for (EducationalDetails details : educations) {
            if (Objects.equals(details.getId(), eId)) {
                return details;
            }
        }
        throw new EducationNotFoundException(eId);
    }

    public void updateEducation(EducationalDetails newDetails, Long eId) {
        for (EducationalDetails details : educations) {
            if (Objects.equals(details.getId(), eId)) {
                details.update(newDetails);
                return;
            }
        }
        throw new EducationNotFoundException(eId);
    }

    public void deleteEducation(Long eId) {
        educations.removeIf(ed -> Objects.equals(ed.getId(), eId));
    }

    public ExperienceDetails getExperience(Long eId) {
        for (ExperienceDetails details : experiences) {
            if (Objects.equals(details.getId(), eId)) {
                return details;
            }
        }
        throw new ExperienceNotFoundException(eId);
    }

    public void updateExperience(ExperienceDetails newDetails, Long eId) {
        for (ExperienceDetails details : experiences) {
            if (Objects.equals(details.getId(), eId)) {
                details.update(newDetails);
                return;
            }
        }
        throw new ExperienceNotFoundException(eId);
    }

    public void deleteExperience(Long eId) {
        experiences.removeIf(ed -> Objects.equals(ed.getId(), eId));
    }

    public Project getProject(Long eId) {
        for (Project details : projects) {
            if (Objects.equals(details.getId(), eId)) {
                return details;
            }
        }
        throw new ProjectNotFoundException(eId);
    }

    public void updateProject(Project newDetails, Long eId) {
        for (Project details : projects) {
            if (Objects.equals(details.getId(), eId)) {
                details.update(newDetails);
                return;
            }
        }
        throw new ProjectNotFoundException(eId);
    }

    public void deleteProject(Long eId) {
        projects.removeIf(ed -> Objects.equals(ed.getId(), eId));
    }

    public boolean similar(Portfolio other) {
        for (EducationalDetails ed : educations) {
            boolean fMatched = false;
            for (EducationalDetails otherEd : other.educations) {
                if (ed.similar(otherEd)) {
                    fMatched = true;
                    break;
                }
            }
            if (!fMatched) {
                return false;
            }
        }
        for (ExperienceDetails exp : experiences) {
            boolean fMatched = false;
            for (ExperienceDetails otherExp : other.experiences) {
                if (exp.similar(otherExp)) {
                    fMatched = true;
                    break;
                }
            }
            if (!fMatched) {
                return false;
            }
        }
        for (Project proj : projects) {
            boolean fMatched = false;
            for (Project otherProj : other.projects) {
                if (proj.similar(otherProj)) {
                    fMatched = true;
                    break;
                }
            }
            if (!fMatched) {
                return false;
            }
        }
        return true;
    }

}
