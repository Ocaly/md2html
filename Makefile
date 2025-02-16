SINGLE_IN = ./tests/single.md
SINGLE_OUT = $(SINGLE_IN:%.md=%.html)

# HTML relative to Markdown files
MULTIPLE_IN = $(shell find ./tests/multiple_md -type f -regex '.*\.md')
MULTIPLE_OUT = $(MULTIPLE_IN:%.md=%.html)

# HTML in seperate folder.
MULTIPLE_HTML = tests/multiple_html
$(MULTIPLE_HTML): tests/multiple_md
	php rec_md2html.php $< $@

%.html: %.md
	php md2html.php $< $@

all: $(SINGLE_OUT) $(MULTIPLE_OUT)

clean:
	rm -f $(SINGLE_OUT)
	rm -rf $(MULTIPLE_HTML)
	rm -f $(MULTIPLE_OUT)

re: clean all

.PHONY: multiple single all clean re fclean fre
