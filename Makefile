SINGLE_IN = ./tests/single.md
SINGLE_OUT = $(SINGLE_IN:%.md=%.html)

MULTIPLE_IN = $(shell find ./tests/multiple_md -type f -regex '.*\.md')
MULTIPLE_OUT = $(MULTIPLE_IN:%.md=%.html)

%.html: %.md
	php md2html.php $< $@

all: $(SINGLE_OUT) $(MULTIPLE_OUT)

clean:
	rm -f $(SINGLE_OUT)
	rm -f $(MULTIPLE_OUT)

re: clean all

.PHONY: multiple single all clean re fclean fre
