package CSEN275.DPG;

import CSEN275.DPG.model.User;
import CSEN275.DPG.repository.UserRepository;
import com.fasterxml.jackson.databind.ObjectMapper;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.web.servlet.AutoConfigureMockMvc;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.http.MediaType;
import org.springframework.security.provisioning.InMemoryUserDetailsManager;
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
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.put;
import static org.springframework.test.web.servlet.result.MockMvcResultHandlers.print;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.jsonPath;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.status;

@SpringBootTest
@AutoConfigureMockMvc
public class UserTest {
    @Autowired
    private WebApplicationContext context;

    private MockMvc mvc;

    @Autowired
    private InMemoryUserDetailsManager userDetailsManager;

    @Autowired
    private UserRepository userRepository;

    private ObjectMapper mapper;

    @BeforeEach
    public void setup() {
        mvc = MockMvcBuilders
                .webAppContextSetup(context)
                .apply(springSecurity())
                .build();
        mapper = new ObjectMapper();
    }

    @Test
    @Transactional
    void getUser() throws Exception {
        User defaultUser = createDefaultUser();
        userRepository.save(defaultUser);
        this.mvc.perform(get("/users/%d".formatted(defaultUser.getId())))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$.id", is(defaultUser.getId()), Long.class))
                .andExpect(jsonPath("$.name", is(defaultUser.getName())))
                .andExpect(jsonPath("$.email", is(defaultUser.getEmail())))
                .andExpect(jsonPath("$.contact", is(defaultUser.getContact())))
                .andExpect(jsonPath("$.age", is(defaultUser.getAge())))
                .andExpect(jsonPath("$.residence", is(defaultUser.getResidence())))
                .andExpect(jsonPath("$.address", is(defaultUser.getAddress())))
                .andExpect(jsonPath("$.aboutme", is(defaultUser.getAboutme())));;
    }

    @Test
    void getUsers() throws Exception {
        this.mvc.perform(get("/users"))
                .andExpect(status().isOk());
    }

    @Test
    @Transactional
    void putUser() throws Exception {
        User newUser = createDefaultUser();
        this.mvc.perform(post("/users").with(csrf())
                .contentType(MediaType.APPLICATION_JSON)
                .content(mapper.writeValueAsString(newUser)))
                .andExpect(status().isCreated())
                .andExpect(jsonPath("$.id", notNullValue()))
                .andExpect(jsonPath("$.name", is(newUser.getName())))
                .andExpect(jsonPath("$.email", is(newUser.getEmail())))
                .andExpect(jsonPath("$.contact", is(newUser.getContact())))
                .andExpect(jsonPath("$.age", is(newUser.getAge())))
                .andExpect(jsonPath("$.residence", is(newUser.getResidence())))
                .andExpect(jsonPath("$.address", is(newUser.getAddress())))
                .andExpect(jsonPath("$.aboutme", is(newUser.getAboutme())));
    }

    @Test
    @Transactional
    void updateUser() throws Exception {
        User defaultUser = createDefaultUser();
        userRepository.save(defaultUser);
        defaultUser.setAboutme("New info about me, John.");
        String url = "/users/%d".formatted(defaultUser.getId());

        this.mvc
                .perform(put(url).with(csrf())
                .contentType(MediaType.APPLICATION_JSON)
                .content(mapper.writeValueAsString(defaultUser)))
                .andExpect(status().isCreated())
                .andExpect(jsonPath("$.aboutme", is(defaultUser.getAboutme())));

        this.mvc
                .perform(put("/users/-1").with(csrf())
                        .contentType(MediaType.APPLICATION_JSON)
                        .content(mapper.writeValueAsString(defaultUser)))
                .andExpect(status().is4xxClientError())
                .andDo(print());
    }

    @Test
    @Transactional
    void deleteUser() throws Exception {
        User defaultUser = createDefaultUser();
        userRepository.save(defaultUser);
        this.mvc.perform(get("/users/%d".formatted(defaultUser.getId())))
                .andExpect(status().isOk());

        this.mvc.perform(delete("/users/%d".formatted(defaultUser.getId())).with(csrf()))
                .andExpect(status().isNoContent());

        this.mvc.perform(get("/users/%d".formatted(defaultUser.getId())))
                .andExpect(status().is4xxClientError());
    }

    static User createDefaultUser() {
        String name = "John Doe";
        String email = "john.doe@example.com";
        String phoneNumber = "(800) 555-0100";
        int age = 21;
        String residence = "Santa Clara";
        String address = "123 Example Street";
        String aboutme = "Hello, I am John Doe";
        return new User(name, email, phoneNumber, age, residence, address, aboutme);
    }
}
