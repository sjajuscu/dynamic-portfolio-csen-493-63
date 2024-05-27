package CSEN275.DPG;

import CSEN275.DPG.model.EducationalDetails;
import CSEN275.DPG.model.ExperienceDetails;
import CSEN275.DPG.model.Portfolio;
import CSEN275.DPG.model.Project;
import CSEN275.DPG.model.User;
import CSEN275.DPG.repository.PortfolioRepository;
import CSEN275.DPG.repository.UserRepository;
import com.fasterxml.jackson.databind.ObjectMapper;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.web.servlet.AutoConfigureMockMvc;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.http.MediaType;
import org.springframework.test.web.servlet.MockMvc;
import org.springframework.test.web.servlet.setup.MockMvcBuilders;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.web.context.WebApplicationContext;

import static org.hamcrest.Matchers.is;
import static org.hamcrest.Matchers.notNullValue;
import static org.springframework.security.test.web.servlet.request.SecurityMockMvcRequestPostProcessors.csrf;
import static org.springframework.security.test.web.servlet.setup.SecurityMockMvcConfigurers.springSecurity;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.delete;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.get;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.post;
import static org.springframework.test.web.servlet.result.MockMvcResultHandlers.print;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.jsonPath;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.status;

@SpringBootTest
@AutoConfigureMockMvc
public class PortfolioControllerTest {
    @Autowired
    private WebApplicationContext context;

    private MockMvc mvc;
    private ObjectMapper mapper;

    @Autowired
    private PortfolioRepository portfolioRepository;
    @Autowired
    private UserRepository userRepository;

    Portfolio createDefaultPortfolio() {
        User defaultUser = UserTest.createDefaultUser();
        userRepository.save(defaultUser);
        return new Portfolio(defaultUser);
    }

    @BeforeEach
    public void setup() {
        mvc = MockMvcBuilders
                .webAppContextSetup(context)
                .apply(springSecurity())
                .build();
        mapper = new ObjectMapper();
    }

    @Test
    void getAllPortfolios() throws Exception {
        this.mvc.perform(get("/portfolios"))
                .andExpect(status().isOk());
    }

    @Test
    @Transactional
    void getPortfolio() throws Exception {
        Portfolio defaultPortfolio = createDefaultPortfolio();
        portfolioRepository.save(defaultPortfolio);
        String url = "/portfolios/%d".formatted(defaultPortfolio.getId());
        this.mvc.perform(get(url))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$.id", notNullValue()))
                .andExpect(jsonPath("$.userId", is(defaultPortfolio.getUserId()), Long.class))
                .andDo(print());

        this.mvc.perform(get("/portfolios/-1"))
                .andExpect(status().isNotFound());
    }

    @Test
    @Transactional
    void putPortfolio() throws Exception {
        Portfolio defaultPortfolio = createDefaultPortfolio();
        this.mvc.perform(post("/portfolios").with(csrf())
                        .contentType(MediaType.APPLICATION_JSON)
                        .content(mapper.writeValueAsString(defaultPortfolio)))
                .andExpect(status().isCreated())
                .andDo(print());

        // Duplicate post should error with bad request.
        this.mvc.perform(post("/portfolios").with(csrf())
                        .contentType(MediaType.APPLICATION_JSON)
                        .content(mapper.writeValueAsString(defaultPortfolio)))
                .andExpect(status().isBadRequest());
    }

    @Test
    @Transactional
    void putEducationalDetails() throws Exception {
        Portfolio defaultPortfolio = createDefaultPortfolio();
        portfolioRepository.save(defaultPortfolio);
        EducationalDetails educationalDetails = DatabaseTest.createSCUDetails();
        String url = "/portfolios/%d/educations".formatted(defaultPortfolio.getId());
        String path = "$._embedded.educationalDetailsList[0]";

        this.mvc.perform(post(url).with(csrf())
                        .contentType(MediaType.APPLICATION_JSON)
                        .content(mapper.writeValueAsString(educationalDetails)))
                .andExpect(status().isOk())
                .andExpect(jsonPath(path + ".school", is(educationalDetails.getSchool())))
                .andExpect(jsonPath(path + ".degree", is(educationalDetails.getDegree())))
                .andExpect(jsonPath(path + ".yearStart", is(educationalDetails.getYearStart())))
                .andExpect(jsonPath(path + ".yearEnd", is(educationalDetails.getYearEnd())))
                .andDo(print());
    }

    @Test
    @Transactional
    void getEducationalDetails() throws Exception {
        Portfolio defaultPortfolio = createDefaultPortfolio();
        EducationalDetails educationalDetails = DatabaseTest.createSCUDetails();
        defaultPortfolio.addEducationalDetails(educationalDetails);
        portfolioRepository.save(defaultPortfolio);
        String url = "/portfolios/%d/educations";
        String path = "$._embedded.educationalDetailsList[0]";

        this.mvc.perform(get(url.formatted(defaultPortfolio.getId())))
                .andExpect(status().isOk())
                .andExpect(jsonPath(path + ".school", is(educationalDetails.getSchool())))
                .andExpect(jsonPath(path + ".degree", is(educationalDetails.getDegree())))
                .andExpect(jsonPath(path + ".yearStart", is(educationalDetails.getYearStart())))
                .andExpect(jsonPath(path + ".yearEnd", is(educationalDetails.getYearEnd())))
                .andDo(print());

        this.mvc.perform(get(url.formatted(-1)))
                .andExpect(status().isNotFound());
    }

    @Test
    @Transactional
    void updateEducationalDetails() throws Exception {
        Portfolio defaultPortfolio = createDefaultPortfolio();
        EducationalDetails educationalDetails = DatabaseTest.createSCUDetails();
        defaultPortfolio.addEducationalDetails(educationalDetails);
        portfolioRepository.save(defaultPortfolio);
        String url = "/portfolios/%d/educations/%d".formatted(defaultPortfolio.getId(), educationalDetails.getId());

        educationalDetails.setMajors("Biology");
        educationalDetails.setYearEnd(2026);

        this.mvc.perform(post(url).with(csrf())
                        .contentType(MediaType.APPLICATION_JSON)
                        .content(mapper.writeValueAsString(educationalDetails)))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$.majors", is(educationalDetails.getMajors())))
                .andExpect(jsonPath("$.yearEnd", is(educationalDetails.getYearEnd())))
                .andDo(print());
    }

    @Test
    @Transactional
    void deleteEducationDetails() throws Exception {
        Portfolio defaultPortfolio = createDefaultPortfolio();
        EducationalDetails educationalDetails = DatabaseTest.createSCUDetails();
        defaultPortfolio.addEducationalDetails(educationalDetails);
        portfolioRepository.save(defaultPortfolio);
        String getUrl = "/portfolios/%d/educations".formatted(defaultPortfolio.getId());

        this.mvc.perform(get(getUrl))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$._embedded", notNullValue()))
                .andDo(print());

        String url = "/portfolios/%d/educations/%d".formatted(defaultPortfolio.getId(), educationalDetails.getId());
        this.mvc.perform(delete(url).with(csrf()))
                .andExpect(status().isNoContent());

        this.mvc.perform(get(getUrl))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$._embedded").doesNotExist())
                .andDo(print());
    }

    @Test
    @Transactional
    void getExperienceDetails() throws Exception {
        Portfolio defaultPortfolio = createDefaultPortfolio();
        ExperienceDetails experienceDetails = DatabaseTest.createJobExperience();
        defaultPortfolio.addExperienceDetails(experienceDetails);
        portfolioRepository.save(defaultPortfolio);
        String url = "/portfolios/%d/experiences";
        String path = "$._embedded.experienceDetailsList[0]";

        this.mvc.perform(get(url.formatted(defaultPortfolio.getId())))
                .andExpect(status().isOk())
                .andExpect(jsonPath(path + ".company", is(experienceDetails.getCompany())))
                .andExpect(jsonPath(path + ".details", is(experienceDetails.getDetails())))
                .andExpect(jsonPath(path + ".yearStart", is(experienceDetails.getYearStart())))
                .andExpect(jsonPath(path + ".yearEnd", is(experienceDetails.getYearEnd())))
                .andDo(print());

        this.mvc.perform(get(url.formatted(-1)))
                .andExpect(status().isNotFound());
    }

    @Test
    @Transactional
    void putExperienceDetails() throws Exception {
        Portfolio defaultPortfolio = createDefaultPortfolio();
        portfolioRepository.save(defaultPortfolio);
        ExperienceDetails experienceDetails = DatabaseTest.createJobExperience();
        String url = "/portfolios/%d/experiences".formatted(defaultPortfolio.getId());
        String path = "$._embedded.experienceDetailsList[0]";

        this.mvc.perform(post(url).with(csrf())
                        .contentType(MediaType.APPLICATION_JSON)
                        .content(mapper.writeValueAsString(experienceDetails)))
                .andExpect(status().isOk())
                .andExpect(jsonPath(path + ".company", is(experienceDetails.getCompany())))
                .andExpect(jsonPath(path + ".details", is(experienceDetails.getDetails())))
                .andExpect(jsonPath(path + ".yearStart", is(experienceDetails.getYearStart())))
                .andExpect(jsonPath(path + ".yearEnd", is(experienceDetails.getYearEnd())))
                .andDo(print());
    }

    @Test
    @Transactional
    void updateExperienceDetails() throws Exception {
        Portfolio defaultPortfolio = createDefaultPortfolio();
        ExperienceDetails experienceDetails = DatabaseTest.createJobExperience();
        defaultPortfolio.addExperienceDetails(experienceDetails);
        portfolioRepository.save(defaultPortfolio);
        Long portfolioId = defaultPortfolio.getId();
        String url = "/portfolios/%d/experiences/%d";

        experienceDetails.setCompany("Amazon");
        experienceDetails.setDetails("Amazon AWS Engineer Intern");

        this.mvc.perform(post(url.formatted(portfolioId, experienceDetails.getId())).with(csrf())
                        .contentType(MediaType.APPLICATION_JSON)
                        .content(mapper.writeValueAsString(experienceDetails)))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$.company", is(experienceDetails.getCompany())))
                .andExpect(jsonPath("$.details", is(experienceDetails.getDetails())))
                .andDo(print());

        this.mvc.perform(post(url.formatted(portfolioId, -1)).with(csrf())
                        .contentType(MediaType.APPLICATION_JSON)
                        .content(mapper.writeValueAsString(experienceDetails)))
                .andExpect(status().isNotFound());
    }

    @Test
    @Transactional
    void deleteExperienceDetails() throws Exception {
        Portfolio defaultPortfolio = createDefaultPortfolio();
        ExperienceDetails experienceDetails = DatabaseTest.createJobExperience();
        defaultPortfolio.addExperienceDetails(experienceDetails);
        portfolioRepository.save(defaultPortfolio);
        String getUrl = "/portfolios/%d/experiences".formatted(defaultPortfolio.getId());

        this.mvc.perform(get(getUrl))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$._embedded", notNullValue()))
                .andDo(print());

        String url = "/portfolios/%d/experiences/%d".formatted(defaultPortfolio.getId(), experienceDetails.getId());
        this.mvc.perform(delete(url).with(csrf()))
                .andExpect(status().isNoContent());

        this.mvc.perform(get(getUrl))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$._embedded").doesNotExist())
                .andDo(print());
    }

    @Test
    @Transactional
    void getProjects() throws Exception {
        Portfolio defaultPortfolio = createDefaultPortfolio();
        Project project = DatabaseTest.createProject();
        defaultPortfolio.addProject(project);
        portfolioRepository.save(defaultPortfolio);
        String url = "/portfolios/%d/projects";
        String path = "$._embedded.projectList[0]";

        this.mvc.perform(get(url.formatted(defaultPortfolio.getId())))
                .andExpect(status().isOk())
                .andExpect(jsonPath(path + ".title", is(project.getTitle())))
                .andExpect(jsonPath(path + ".description", is(project.getDescription())))
                .andExpect(jsonPath(path + ".yearStart", is(project.getYearStart())))
                .andExpect(jsonPath(path + ".yearEnd", is(project.getYearEnd())))
                .andDo(print());

        this.mvc.perform(get(url.formatted(-1)))
                .andExpect(status().isNotFound());
    }

    @Test
    @Transactional
    void putProjects() throws Exception {
        Portfolio defaultPortfolio = createDefaultPortfolio();
        portfolioRepository.save(defaultPortfolio);
        Project project = DatabaseTest.createProject();
        String url = "/portfolios/%d/projects".formatted(defaultPortfolio.getId());
        String path = "$._embedded.projectList[0]";

        this.mvc.perform(post(url).with(csrf())
                        .contentType(MediaType.APPLICATION_JSON)
                        .content(mapper.writeValueAsString(project)))
                .andExpect(status().isOk())
                .andExpect(jsonPath(path + ".title", is(project.getTitle())))
                .andExpect(jsonPath(path + ".description", is(project.getDescription())))
                .andExpect(jsonPath(path + ".yearStart", is(project.getYearStart())))
                .andExpect(jsonPath(path + ".yearEnd", is(project.getYearEnd())))
                .andDo(print());
    }

    @Test
    @Transactional
    void updateProject() throws Exception {
        Portfolio defaultPortfolio = createDefaultPortfolio();
        Project project = DatabaseTest.createProject();
        defaultPortfolio.addProject(project);
        portfolioRepository.save(defaultPortfolio);
        Long portfolioId = defaultPortfolio.getId();
        String url = "/portfolios/%d/projects/%d";

        project.setTitle("Dynamic Portfolio Generator");
        project.setDescription("Dynamically creates a portfolio for you.");

        this.mvc.perform(post(url.formatted(portfolioId, project.getId())).with(csrf())
                        .contentType(MediaType.APPLICATION_JSON)
                        .content(mapper.writeValueAsString(project)))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$.title", is(project.getTitle())))
                .andExpect(jsonPath("$.description", is(project.getDescription())))
                .andDo(print());

        this.mvc.perform(post(url.formatted(portfolioId, -1)).with(csrf())
                        .contentType(MediaType.APPLICATION_JSON)
                        .content(mapper.writeValueAsString(project)))
                .andExpect(status().isNotFound());
    }

    @Test
    @Transactional
    void deleteProject() throws Exception {
        Portfolio defaultPortfolio = createDefaultPortfolio();
        Project project = DatabaseTest.createProject();
        defaultPortfolio.addProject(project);
        portfolioRepository.save(defaultPortfolio);
        String getUrl = "/portfolios/%d/projects".formatted(defaultPortfolio.getId());

        this.mvc.perform(get(getUrl))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$._embedded", notNullValue()))
                .andDo(print());

        String url = "/portfolios/%d/projects/%d".formatted(defaultPortfolio.getId(), project.getId());
        this.mvc.perform(delete(url).with(csrf()))
                .andExpect(status().isNoContent());

        this.mvc.perform(get(getUrl))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$._embedded").doesNotExist())
                .andDo(print());
    }
}
